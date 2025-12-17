@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 bg-gradient">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Header -->
            <div class="card mb-4 shadow-lg border-0">
                <div class="card-body p-4 text-center">
                    <h1 class="text-primary mb-3">🏆 Vadības tabula</h1>
                    <p class="text-muted fs-5 mb-0">Skatiet labākos spēlētājus katram grūtības līmenim</p>
                </div>
            </div>

            <!-- Difficulty Tabs -->
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-white" data-bs-toggle="tab" href="#easy">
                                🟢 Viegli
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" data-bs-toggle="tab" href="#medium">
                                🟡 Vidēji
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" data-bs-toggle="tab" href="#hard">
                                🔴 Grūti
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" data-bs-toggle="tab" href="#hardcore">
                                ⚫ Ultragausi
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <!-- Easy Leaderboard -->
                        <div class="tab-pane fade show active" id="easy">
                            @include('partials.leaderboard-table', [
                                'results' => $leaderboard['easy'],
                                'difficulty' => 'Easy'
                            ])
                        </div>

                        <!-- Medium Leaderboard -->
                        <div class="tab-pane fade" id="medium">
                            @include('partials.leaderboard-table', [
                                'results' => $leaderboard['medium'],
                                'difficulty' => 'Medium'
                            ])
                        </div>

                        <!-- Hard Leaderboard -->
                        <div class="tab-pane fade" id="hard">
                            @include('partials.leaderboard-table', [
                                'results' => $leaderboard['hard'],
                                'difficulty' => 'Hard'
                            ])
                        </div>

                        <!-- HardCore Leaderboard -->
                        <div class="tab-pane fade" id="hardcore">
                            @include('partials.leaderboard-table', [
                                'results' => $leaderboard['hardcore'],
                                'difficulty' => 'HardCore'
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Game Button -->
            <div class="text-center mb-4">
                <a href="/game" class="btn btn-lg btn-primary me-2">
                    <i class="fas fa-arrow-left"></i> Atpakaļ uz spēli
                </a>
                <a href="/" class="btn btn-lg btn-secondary">
                    <i class="fas fa-home"></i> Sākumlapa
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 16px;
    }

    .nav-tabs .nav-link.active {
        border-bottom: 3px solid white;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-tabs .nav-link:hover {
        border-bottom: 3px solid rgba(255, 255, 255, 0.5);
    }

    .table thead {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        color: #495057;
    }

    .table tbody tr {
        border-bottom: 1px solid #dee2e6;
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .rank-medal {
        font-size: 24px;
        font-weight: bold;
    }

    .rank-1 {
        color: #ffd700;
    }

    .rank-2 {
        color: #c0c0c0;
    }

    .rank-3 {
        color: #cd7f32;
    }

    .stat-badge {
        font-size: 14px;
        padding: 6px 12px;
        font-weight: 600;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 20px;
        color: #dee2e6;
    }

    .empty-state h4 {
        color: #495057;
        margin-top: 10px;
    }
</style>

<script>
    // Add smooth animations
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.nav-link').forEach(l => {
                l.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
</script>
@endsection
