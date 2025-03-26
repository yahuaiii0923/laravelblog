<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Contact;
use App\Models\Plushie;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(3)->get();
        return view('main', compact('posts'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);
        Contact::create($validated);
        return redirect()->back()->with('success', 'Thank you for your message!');
    }

    public function care()
    {
        return view('care');
    }

    public function measure()
    {
        return view('measure');
    }

    public function gifting()
    {
        return view('gifting');
    }

    public function matchmaker()
    {
        $traits = [
            'personality' => ['Cuddly & Soft', 'Playful & Energetic', 'Quirky & Unique', 'Calm & Gentle', 'Loyal & Protective'],
            'color' => ['Pastel Colors', 'Neutral Colors', 'Bright & Vibrant', 'Earthy & Natural', 'Monochrome'],
            'features' => ['Floppy Ears', 'Big Round Eyes', 'Tiny & Pocket-Sized', 'Long Tail', 'Colorful Petals']
        ];

        return view('matchmaker', compact('traits'));
    }

        public function processMatchmaker(Request $request)
        {
            $validated = $request->validate([
                    'personality' => 'nullable|in:cuddly-soft,playful-energetic,quirky-unique,calm-gentle,loyal-protective',
                    'color' => 'nullable|in:pastel-colors,neutral-colors,bright-vibrant,earthy-natural,monochrome',
                    'features' => 'nullable|in:floppy-ears,big-round-eyes,tiny-pocket-sized,long-tail,colorful-petals',
                    'seed' => 'required|string'
                ]);

            $plushie = $this->determinePlushie($validated);

            return response()->json($plushie ? [
                'name' => $plushie->name,
                'image_url' => $plushie->image_url,
                'story' => $plushie->story
            ] : [
                'error' => 'No plushie found for these traits'
            ], $plushie ? 200 : 404);
        }

        private function determinePlushie($answers)
        {
            $query = Plushie::query();
            $selectedTraits = 0;

            foreach (['personality', 'color', 'features'] as $trait) {
                if (!empty($answers[$trait])) {
                    if ($trait === 'features') {
                        $query->whereJsonContains("traits->{$trait}", $answers[$trait]);
                    } else {
                        $query->where("traits->{$trait}", $answers[$trait]);
                    }
                    $selectedTraits++;
                }
            }

            // Priority: exact matches first
            $query->orderByRaw("
                (JSON_EXTRACT(traits, '$.personality') = ?) DESC,
                (JSON_EXTRACT(traits, '$.color') = ?) DESC,
                (JSON_CONTAINS(JSON_EXTRACT(traits, '$.features'), ?)) DESC",
                [
                    $answers['personality'] ?? '""',
                    $answers['color'] ?? '""',
                    '"' . ($answers['features'] ?? '') . '"'
                ]
            );

            $seed = hexdec(substr(md5($answers['seed']), 0, 7));
            $query->inRandomOrder($seed);

            return $query->first() ?? Plushie::inRandomOrder($seed)->first();
        }
}
