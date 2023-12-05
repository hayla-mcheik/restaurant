<?php
function getUserDashboardLink() {
    $user = auth()->user();

    if ($user) {
        switch ($user->role_as) {
            case '1':
                return route('admin.dashboard');
            case '2':
                return route('manager.dashboard');
            case '3':
                return route('user.dashboard');
            default:
                return '#';
        }
    } else {
        return redirect('frontend.home');
    }
}
