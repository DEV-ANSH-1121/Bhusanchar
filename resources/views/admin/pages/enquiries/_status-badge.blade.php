@php
    $tone = match ($record->status) {
        $record::STATUS_NEW => 'bg-amber-100 text-amber-800 dark:bg-amber-950/50 dark:text-amber-200',
        $record::STATUS_IN_PROGRESS => 'bg-sky-100 text-sky-800 dark:bg-sky-950/50 dark:text-sky-200',
        $record::STATUS_CLOSED => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-200',
        default => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200',
    };
@endphp

<span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $tone }}">{{ $record->statusLabel() }}</span>
