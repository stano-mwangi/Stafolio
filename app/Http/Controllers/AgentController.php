<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Skill;
use App\Models\Technology;
use App\Models\Education;
use App\Models\Project;
use App\Models\ContactInfo;
use App\Models\Page;

class AgentController extends Controller
{
    public function ask(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'question' => 'required|string|max:1000|min:3',
                'history' => 'sometimes|array'
            ]);

            $question = trim($validated['question']);
            $history = $request->input('history', []);

            if (!is_array($history)) {
                throw new \Exception('Invalid conversation history format.');
            }

            $validatedHistory = [];
            foreach ($history as $message) {
                if (!is_array($message) || !isset($message['role'], $message['content'])) {
                    throw new \Exception('Invalid conversation history format.');
                }

                $role = $message['role'];
                $content = trim($message['content']);

                if (!in_array($role, ['user', 'assistant'], true) || $content === '') {
                    continue;
                }

                $validatedHistory[] = [
                    'role' => $role,
                    'content' => $content,
                ];
            }

            // Fetch portfolio data
            $portfolioData = $this->getPortfolioData();

            // Create system prompt
            $systemPrompt = $this->createSystemPrompt($portfolioData);

            // Call OpenRouter API with full conversation history
            $response = $this->callOpenRouterAPI($systemPrompt, $validatedHistory, $question);

            return response()->json([
                'answer' => $response
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Invalid input. Question must be between 3-1000 characters.'
            ], 422);
        } catch (\Exception $e) {
            Log::error('AI Agent Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Sorry, I\'m having trouble processing your question right now. Please try again later.'
            ], 500);
        }
    }

    private function getPortfolioData()
    {
        return [
            'skills' => Skill::all()->toArray(),
            'technologies' => Technology::all()->toArray(),
            'education' => Education::orderBy('year_from', 'desc')->get()->toArray(),
            'projects' => Project::all()->toArray(),
            'contact_info' => ContactInfo::all()->toArray(),
            'pages' => Page::all()->toArray(),
        ];
    }

    private function createSystemPrompt($data)
    {
        $context = json_encode($data, JSON_PRETTY_PRINT);

        return "You are a professional AI assistant representing Stanley Mwangi, a skilled developer and cybersecurity enthusiast. You have access to Stanley's complete portfolio information including their skills, technologies, education, projects, and contact details.

PORTFOLIO DATA:
{$context}

INSTRUCTIONS:
- Answer questions about Stanley's projects, skills, experience, education, and technologies
- Be professional, concise, and helpful
- Use the portfolio data to provide accurate information
- If asked about something not in the portfolio data, politely say you don't have that information
- Never expose or mention the raw JSON data structure
- Keep responses conversational but professional
- Highlight Stanley's expertise in backend development, cybersecurity, and automation
- If appropriate, suggest contacting Stanley for more details

Remember: You are speaking as Stanley's professional representative, not as an AI.";
    }

    private function callOpenRouterAPI($systemPrompt, array $history, $userQuestion)
    {
        $apiKey = config('services.openrouter.key') ?? env('OPENROUTER_API_KEY');
        $baseUrl = config('services.openrouter.url') ?? env('OPENROUTER_BASE_URL', 'https://openrouter.ai/api/v1');
        $model = config('services.openrouter.model') ?? env('OPENROUTER_MODEL', 'microsoft/wizardlm-2-8x22b');

        if (!$apiKey) {
            throw new \Exception('OpenRouter API key not configured');
        }

        $messages = [
            [
                'role' => 'system',
                'content' => $systemPrompt
            ]
        ];

        foreach ($history as $message) {
            $messages[] = [
                'role' => $message['role'],
                'content' => $message['content'],
            ];
        }

        $lastMessage = end($history);
        if (!$lastMessage || $lastMessage['role'] !== 'user' || $lastMessage['content'] !== $userQuestion) {
            $messages[] = [
                'role' => 'user',
                'content' => $userQuestion
            ];
        }

        $response = Http::timeout(30)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
            ])
            ->post($baseUrl . '/chat/completions', [
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

        if (!$response->successful()) {
            Log::error('OpenRouter API Error: ' . $response->body());
            throw new \Exception('Failed to get response from AI service');
        }

        $data = $response->json();

        if (!isset($data['choices'][0]['message']['content'])) {
            throw new \Exception('Invalid response format from AI service');
        }

        return trim($data['choices'][0]['message']['content']);
    }
}
