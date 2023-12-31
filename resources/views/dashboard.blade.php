@extends('layouts.app')

@section('content')

    <style>
        :root {
            --background-light: #f4f4f4;
            --text-light: #333;
            --background-dark: #333;
            --text-dark: #fff;
            --primary-color: #009879;
            --secondary-color: #f3f3f3;
            --box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        body {
            background-color: var(--background-light);
            color: var(--text-light);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-theme {
            background-color: var(--background-dark);
            color: var(--text-dark);
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: var(--box-shadow);
            border-radius: 10px;
            overflow: hidden;
        }

        .modern-table thead tr {
            background-color: var(--primary-color);
            color: white;
            text-align: left;
        }

        .modern-table th,
        .modern-table td {
            padding: 12px 15px;
        }

        .modern-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .modern-table tbody tr:nth-of-type(even) {
            background-color: var(--secondary-color);
        }

        .modern-table tbody tr:last-of-type {
            border-bottom: 2px solid var(--primary-color);
        }

        .modern-table tbody tr.active-row {
            font-weight: bold;
            color: var(--primary-color);
        }
    </style>

<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}

                        @if(Auth::user()->role_id == 1)
                            CFP
                        @else
                            Branch
                        @endif

                    Role: {{Auth::user()->role->name}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
