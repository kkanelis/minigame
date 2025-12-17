@if($results->isEmpty())
    <div class="empty-state">
        <i class="fas fa-trophy"></i>
        <h4>Vēl nav rezultātu</h4>
        <p>Būt pirmais, kurš apgūs {{ $difficulty }} grūtības līmeni!</p>
        <a href="/game" class="btn btn-primary mt-3">Sākt spēlēt</a>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 30%">Iesauka</th>
                    <th style="width: 20%">Vārdi/min</th>
                    <th style="width: 20%">Precizitāte</th>
                    <th style="width: 20%">Laiks</th>
                    <th style="width: 5%">Datums</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $index => $result)
                    <tr>
                        <td>
                            <span class="rank-medal rank-{{ $index + 1 }}">
                                @if($index + 1 == 1)
                                    🥇
                                @elseif($index + 1 == 2)
                                    🥈
                                @elseif($index + 1 == 3)
                                    🥉
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <strong>{{ $result->nickname }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-success stat-badge">
                                {{ $result->words_per_minute }} v/min
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info stat-badge">
                                {{ $result->accuracy }}%
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-warning stat-badge">
                                {{ sprintf('%02d:%02d', floor($result->time_taken / 60), $result->time_taken % 60) }}
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $result->created_at->diffForHumans() }}</small>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
