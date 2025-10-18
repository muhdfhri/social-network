<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class ProfileEdit extends Component
{
    public function render()
    {
        return view('livewire.profile-edit')->extends('layouts.app');
    }

    public function profileEdit(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $sender = User::where('username', $request->partner)->first();

        DB::beginTransaction();
        try {
            $this->updateUser($user, $request);
            if ($request->relationship != 'single') {
                $this->updateRelationship($user, $sender, $request);
            }
            DB::commit();
            session()->flash('success', 'Your profile has been updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }

        $this->updateProfilePicture($user, $request);
        $this->updateThumbnail($user, $request);

        return redirect()->route('profile.show', Auth::user()->username);
    }

    private function updateUser(User $user, Request $request)
    {
        $partner = ($request->relationship == 'single') ? null : $request->partner;

        // Validasi password hanya jika new_password diisi
        if (!empty($request->new_password)) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            // Update password
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'description' => $request->description,
            'school' => $request->school,
            'college' => $request->college,
            'university' => $request->university,
            'relationship' => $request->relationship,
            'partner' => $partner,
            'work' => $request->work,
            'address' => $request->address,
            'website' => $request->website,
        ]);
    }

    private function updateRelationship(User $user, User $sender, Request $request)
    {
        if ($request->relationship != 'Single') {
            if ($request->partner != $user->partner) {
                $sender->update([
                    'relationship' => $request->relationship,
                    'partner' => $user->username
                ]);
                Notification::create([
                    "type" =>  "Relationship Status",
                    "user_id" => $sender->id,
                    "message" => auth()->user()->username . " is now in a relationship with " . $request->partner,
                    "url" => '/profile/' . $request->partner . '/edit'
                ]);
            }
        }
    }

    private function updateProfilePicture(User $user, Request $request)
    {
        if ($request->hasFile('profile') && $request->profile->getClientOriginalName() != $user->profile) {
            // Hapus file lama jika ada
            if ($user->profile) {
                $oldProfile = public_path('storage/' . $user->profile);
                if (file_exists($oldProfile)) {
                    unlink($oldProfile);
                }
            }

            // Simpan file baru
            $path = $request->file('profile')->store('profiles', 'public');
            $user->profile = $path;
            $user->save();
        }
    }

    private function updateThumbnail(User $user, Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($user->thumbnail) {
                $oldThumbnail = public_path('storage/' . $user->thumbnail);
                if (file_exists($oldThumbnail)) {
                    unlink($oldThumbnail);
                }
            }

            // Simpan thumbnail baru
            $path = $request->file('thumbnail')->store('profiles/thumbnails', 'public');
            $user->thumbnail = $path;
            $user->save();
        }
    }
}
