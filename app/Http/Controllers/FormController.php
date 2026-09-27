<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\NewsletterFormRequest;
use App\Http\Requests\WebinarWatchFormRequest;
use App\Models\HubspotSetting;
use App\Services\HubSpotFormService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function newsletter(NewsletterFormRequest $request, HubSpotFormService $hubSpot): RedirectResponse
    {
        $data = $request->validated();
        Log::info('Newsletter subscription received', $data);

        $hubSpotError = $this->hubSpotFailureResponse(
            $hubSpot->submitNewsletter($data, $request),
            HubspotSetting::current()->isReadyForNewsletter()
        );

        if ($hubSpotError !== null) {
            return $hubSpotError;
        }

        return back()->with('newsletter_success', 'Thank you for subscribing to our newsletter!');
    }

    public function contact(ContactFormRequest $request, HubSpotFormService $hubSpot): RedirectResponse
    {
        $data = $request->validated();
        Log::info('Contact form submission received', $data);

        $hubSpotError = $this->hubSpotFailureResponse(
            $hubSpot->submitContact($data, $request),
            HubspotSetting::current()->isReadyForContact()
        );

        if ($hubSpotError !== null) {
            return $hubSpotError;
        }

        return back()->with('contact_success', 'Thank you! Your message has been received. We will contact you soon.');
    }

    private function hubSpotFailureResponse(bool $hubSpotOk, bool $hubSpotRequired): ?RedirectResponse
    {
        if ($hubSpotOk || ! $hubSpotRequired) {
            return null;
        }

        return back()
            ->withInput()
            ->withErrors(['form' => 'We could not submit your request right now. Please try again or contact us by phone.']);
    }

    public function webinarWatch(WebinarWatchFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $webinar = WebinarController::find($data['webinar_slug']);

        Log::info('Webinar registration received', [
            'webinar_slug' => $data['webinar_slug'],
            'webinar_title' => $webinar['title'] ?? null,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);

        $videoUrl = trim((string) ($webinar['video_url'] ?? ''));

        if ($videoUrl !== '') {
            return redirect()->away($videoUrl);
        }

        return redirect()
            ->route('webinar')
            ->with('webinar_watch_success', true)
            ->with('webinar_modal_slug', $data['webinar_slug']);
    }
}
