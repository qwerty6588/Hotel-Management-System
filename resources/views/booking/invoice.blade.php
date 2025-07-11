<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }

        .header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #1a73e8;
        }

        .details-table, .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table td, .summary-table td, .summary-table th {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .summary-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 30px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }

        .text-right {
            text-align: right;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 4px;
            font-size: 12px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Подтверждение бронирования</h1>
        <p>Номер бронирования: <strong>{{ $booking->id }}</strong></p>
        <p>Дата бронирования: {{ $booking->created_at->format('d.m.Y') }}</p>
        <p class="status">Статус: Оплачено</p>
    </div>

    <div class="section">
        <div class="title">Информация о госте</div>
        <table class="details-table">
            <tr>
                <td>Имя</td>
                <td>{{ $booking->user->name ?? 'Гость' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $booking->user->email ?? '–' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="title">Детали бронирования</div>
        <table class="summary-table">
            <tr>
                <th>Отель</th>
                <td>{{ $booking->hotel->name }}</td>
            </tr>
            <tr>
                <th>Адрес</th>
                <td>{{ $booking->hotel->address ?? '–' }}</td>
            </tr>
            <tr>
                <th>Даты проживания</th>
                <td>{{ $booking->check_in }} — {{ $booking->check_out }}</td>
            </tr>
            <tr>
                <th>Количество гостей</th>
                <td>{{ $booking->guests }}</td>
            </tr>
            <tr>
                <th>Цена за ночь</th>
                <td>{{ number_format($booking->hotel->price_per_night, 0, ',', ' ') }} $</td>
            </tr>
            <tr>
                <th>Общее количество ночей</th>
                <td>{{ \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out) }}</td>
            </tr>
            <tr>
                <th>Итоговая сумма</th>
                <td><strong>{{ number_format($booking->total_price, 0, ',', ' ') }} $</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Благодарим за бронирование!<br>
    </div>
</div>
</body>
</html>
