@extends('layouts.app')

@section('title', 'Sākums - Mazās spēles')

@section('content')
<div style="background: #0a0a0a; min-height: 100vh; color: white; padding: 0;">
    <!-- Navigation -->
    <nav style="background: #000; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #222;">
        <div style="font-size: 24px; font-weight: bold; letter-spacing: 3px;">MINIGAMES</div>
        <div style="display: flex; gap: 30px;">
            <a href="/game" style="color: white; text-decoration: none; font-size: 14px;">Games</a>
            <a href="/leaderboard" style="color: white; text-decoration: none; font-size: 14px;">Leaderboard</a>
            <a href="#" style="color: white; text-decoration: none; font-size: 14px;">About</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; padding: 80px 40px; align-items: center; max-width: 1400px; margin: 0 auto;">
        <!-- Left Side -->
        <div>
            <h1 style="font-size: 64px; font-weight: bold; line-height: 1.2; margin-bottom: 30px; text-transform: uppercase; letter-spacing: -2px;">
                <span style="color: #fff;">GAMES</span>
                <span style="color: #666;"> THAT</span>
                <br>
                <span style="color: #666;">SHARPEN</span>
                <br>
                <span style="color: #fff;">YOUR MIND</span>
            </h1>
            <p style="font-size: 16px; color: #999; margin-bottom: 40px; line-height: 1.6;">Challenge yourself with memory and typing games. Compete on leaderboards and improve your skills.</p>
            <a href="/game" style="display: inline-block; padding: 12px 30px; background: white; color: #000; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px;">Play Now</a>
        </div>

        <!-- Right Side - Game Cards -->
        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            <!-- Memory Card -->
            <div style="background: #1a1a1a; padding: 30px; border-radius: 12px; border: 1px solid #333; transition: transform 0.3s;">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 20px;">
                    <div>
                        <div style="font-size: 32px; margin-bottom: 10px;">🃏</div>
                        <h3 style="font-size: 18px; font-weight: bold; margin: 0;">Memory Game</h3>
                    </div>
                    <a href="/memory" style="color: white; text-decoration: none; font-size: 20px;">→</a>
                </div>
                <p style="color: #999; font-size: 13px; margin: 15px 0;">Match pairs of cards</p>
                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <span style="display: inline-block; padding: 4px 12px; background: #0066cc; border-radius: 3px; font-size: 12px;">Easy</span>
                    <span style="display: inline-block; padding: 4px 12px; background: #0066cc; border-radius: 3px; font-size: 12px;">Medium</span>
                    <span style="display: inline-block; padding: 4px 12px; background: #0066cc; border-radius: 3px; font-size: 12px;">Hard</span>
                </div>
            </div>

            <!-- Typing Card -->
            <div style="background: #1a1a1a; padding: 30px; border-radius: 12px; border: 1px solid #333; transition: transform 0.3s;">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 20px;">
                    <div>
                        <div style="font-size: 32px; margin-bottom: 10px;">⌨️</div>
                        <h3 style="font-size: 18px; font-weight: bold; margin: 0;">Typing Game</h3>
                    </div>
                    <a href="/game" style="color: white; text-decoration: none; font-size: 20px;">→</a>
                </div>
                <p style="color: #999; font-size: 13px; margin: 15px 0;">Test your typing speed</p>
                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <span style="display: inline-block; padding: 4px 12px; background: #00aa00; border-radius: 3px; font-size: 12px;">Easy</span>
                    <span style="display: inline-block; padding: 4px 12px; background: #00cc00; border-radius: 3px; font-size: 12px;">Medium</span>
                    <span style="display: inline-block; padding: 4px 12px; background: #ff6600; border-radius: 3px; font-size: 12px;">Hard</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div style="border-top: 1px solid #222; padding: 30px 40px; text-align: center; color: #666; font-size: 12px;">
        <p>© 2026 MiniGames. Play, Compete, Improve.</p>
    </div>
</div>

<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    a[href="/memory"]:hover, a[href="/game"]:hover {
        opacity: 0.8;
    }
</style>
@endsection