<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function data()
    {
        $contacts = Contact::latest()->get();

        return response()->json([
            'data' => $contacts->map(function (Contact $contact) {
                return [
                    'id' => $contact->id,
                    'slug' => $contact->slug,
                    'branch' => $contact->branch,
                    'address' => $contact->address,
                    'phone' => $contact->phone,
                    'email' => $contact->email,
                    'working_hours' => $contact->working_hours,
                    'map_embed_url' => $contact->map_embed_url,
                    'action' => '<button type="button" data-id="' . $contact->id . '" class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>' .
                        '<button type="button" data-id="' . $contact->id . '" class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>' .
                        '<button type="button" data-id="' . $contact->id . '" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>',
                ];
            }),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'unique:contacts,slug'],
            'branch' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'working_hours' => ['required', 'string', 'max:255'],
            'map_embed_url' => ['nullable', 'string'],
        ]);

        Contact::create($validated);

        return back()->with('status', 'Contact saved successfully.');
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'unique:contacts,slug,'.$contact->id],
            'branch' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'working_hours' => ['required', 'string', 'max:255'],
            'map_embed_url' => ['nullable', 'string'],
        ]);

        $contact->update($validated);

        return redirect()->route('contacts.index')->with('status', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('status', 'Contact deleted successfully.');
    }

    public function publicIndex(Request $request): AnonymousResourceCollection
    {
        return ContactResource::collection(
            Contact::query()
                ->when($request->filled('slug'), fn ($query) => $query->where('slug', $request->string('slug')))
                ->when($request->filled('branch'), fn ($query) => $query->where('branch', $request->string('branch')))
                ->orderBy('branch')
                ->get()
        );
    }
}
