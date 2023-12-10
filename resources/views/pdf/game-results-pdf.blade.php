<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
    <style>
        /* Page Style */
        @page {
            font-family: Arial, sans-serif;
            margin: 1em 6em 0em 6em;
            size: letter;
        }

        body {
            margin: 5em 0;
        }

        /* Page Break */
        hr {
            page-break-after: always;
            border: 0;
        }

        /* Header */
        .vertical-line {
            border-left: 3px solid #333;
            height: 70px;
            margin: 0 20px;
            position: fixed;
            top: 5;
            left: 140;
        }

        #header {
            display: flex;
            flex-direction: row;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        #header .event-header {
            display: flex;
            flex-direction: row;
            text-align: start;
            position: fixed;
            top: 15;
            left: 170;
        }

        #header .event-name {
            font-weight: bold;
            font-size: 25px;
            line-height: 90%;
            color: #212529;
        }

        #header .sub-name {
            font-weight: bolder;
            font-style: italic;
            font-size: 14px;
            line-height: 90%;
        }

        #header .logo {
            position: fixed;
            top: 0;
            left: 0;
        }

        /* Title */
        .title {
            display: flex;
            flex-direction: column;
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            font-size: 18px;
        }

        .uc {
            text-transform: uppercase;
        }

        /* Table */
        .table {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .table table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%
        }

        .table table th,
        td {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            padding-right: 10px;
            border: 0.5pt solid black;
        }

        .table table thead tr th {
            font-size: 16px;
        }

        .table table tr td.round-name {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .table tbody td:first-child {
            width: 20%;
        }

        /* Signature */
        .signature {
            margin-top: 15px;
            font-size: 12px;
        }

        .signature table {
            width: 100%;
        }

        .signature table tr td {
            border: none;
            text-align: left;
        }

        .signature table tr td .fill {
            text-align: center
        }

        .signature table tr td .fill .sub-line {
            font-size: 10px;
        }
    </style>
    <title>Game Results</title>
</head>

<body>
    {{-- Header --}}
    <div id="header">
        <div class="logo">
            <img src="{{ public_path('img/philsilat_pdf_logo.png') }}" style="width: 30%; height: auto;" />
        </div>
        <div class="vertical-line"></div>
        <div class="event-header">
            {{-- event name --}}
            <div class="event-name">
                {{ $event->name }} {{ $event->id }}
            </div>
            {{-- date - venue --}}
            <div class="sub-name">{{ \Carbon\Carbon::parse($event->starts_at)->format('M. d, Y') }}
                - {{ $event->venue }}
            </div>
        </div>
    </div>

    {{-- 1st Page Male Category --}}
    <div>
        {{-- Title --}}
        <div class="title">
            <div>PENCAK SILAT - <span class="uc">{{ $game->name }}</span> COMPETITION</div>
            <div>CLASS <span class="uc">{{ $game->category->class_label }}</span> -
                <span class="uc">{{ $game->category->sex }}</span>
            </div>
            <div>GAME RESULTS</div>
        </div>

        {{-- Table --}}
        @foreach ($rounds as $round)
        @php
        $roundMatches = $matches->where('round', $round->round);
        @endphp

        <div class="table">
            <table>
                <tr>
                    <td colspan="4" class="round-name">
                        @if ($roundMatches->where('round', $round->round)->count() === 1)
                        Finals
                        @elseif($roundMatches->where('round', $round->round)->count() === 2)
                        Semi-Finals
                        @else
                        Elimination
                        @endif

                        (Round {{ $round->round }})
                    </td>
                </tr>
                <thead>
                    <tr>
                        <th>Game #</th>
                        <th style="background-color: rgb(253, 70, 70);">Red Corner</th>
                        <th style="background-color: rgb(90, 147, 251);">Blue Corner</th>
                        <th>Round Winner</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roundMatches as $roundMatch)
                    <tr scope="row">
                        <td>
                            {{ $roundMatch->game_no }}
                        </td>
                        <td>
                            <div>
                                {{ $roundMatch->athlete1->team->name ?? '' }}
                            </div>
                            <div>
                                {{ $roundMatch->athlete1()->exists() ? $roundMatch->athlete1->last_name . ', ' .
                                $roundMatch->athlete1->first_name : 'N/A' }}
                            </div>
                        </td>
                        <td>
                            <div>
                                {{ $roundMatch->athlete2->team->name ?? '' }}
                            </div>
                            <div>
                                {{ $roundMatch->athlete2()->exists() ? $roundMatch->athlete2->last_name . ', ' .
                                $roundMatch->athlete2->first_name : 'N/A' }}
                            </div>
                        </td>
                        <td>
                            @if ($roundMatch->winner)
                            <div>
                                {{ $roundMatch->winner->team->name }}
                            </div>
                            <div>
                                {{ $roundMatch->winner()->exists() ? $roundMatch->winner->last_name . ', ' .
                                $roundMatch->winner->first_name : 'N/A' }}
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach

        {{-- Signature --}}
        <div class="signature">
            <table>
                <tr>
                    <td>
                        <div>
                            <p>Prepared by:</p>
                            <br />
                            <div class="fill">
                                <span>______________________________</span>
                                <br />
                                <span class="sub-line">(Name and signature over printed name)</span>
                            </div>
                            <div class="fill">
                                <br>
                                <span>______________________________</span>
                                <br />
                                <span class="sub-line">(position)</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p>Verified by:</p>
                            <br />
                            <div class="fill">
                                <span>______________________________</span>
                                <br />
                                <span class="sub-line">(Name and signature over printed name)</span>
                            </div>
                            <div class="fill">
                                <br>
                                <span>______________________________</span>
                                <br />
                                <span class="sub-line">(position)</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>