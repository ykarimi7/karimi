<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cutomer Filtered</title>
    <style>
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .d-block {
            display: block;
        }

        .w-100 {
            width: 100%;
        }

        .web-bg {
            background-color: #264653;
        }

        body {
            padding: 0;
            margin: 0;
            font-size: 18px;
            line-height: 32px;
        }

        table {
            width: 100%;
        }

        thead {
            padding: 10px;
            text-align: center;
            background-color: #343a40;
            color: white;
        }

        thead tr th {
            padding: 10px 2px;
        }

        tbody tr td {
            border: 1px solid #4a5568;
            color: #1a202c;
            padding: 10px 2px;
            text-align: center;
        }

        tfoot tr {}

        tfoot tr td {
            padding: 10px 2px;
            font-weight: bold;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }

            thead tr th {
                padding: 8px 2px;
            }

            tbody tr td {
                padding: 8px 2px;
            }
        }
    </style>
</head>

<body>
    <header style="display: block; width: 100%;height: 300px">
        <div class="web-bg w-100" style="color: #ffffff;display: inline-block;">
            <div class="card-header py-3 border-0">
                <span style="font-weight: bold">Toplam lisans</span> <span
                    style=" color: #fafcf9; font-weight: bolder">{{ $usercount }}</span> <span
                    style="font-weight: bold; margin-left: 10%;">Kullanılan lisans</span> <span
                    style="color: #fafcf9; font-weight: bolder">{{ $count }}</span>
                <span style="font-weight: bold; margin-left: 10%;">Kalan lisans</span> <span
                    style="color:#fafcf9; font-weight: bolder">{{ $usercount - $count }}</span>
    
            </div>
           
        </div>
    </header>

    <main style="padding: 10px; display: block; width: 100%;margin-top: 5px ">
        <div style="display: block; width: 100%">
            <h2 style="text-align: center; display: block">All Customer Details</h2>
    <table style="position: relative; top: 50px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Ad Soyad</th>
                <th>Şube Adı</th>
                <th>E-posta</th>
                <th>Telefon</th>
                <th>Çevrimiçi zaman</th>
                <th>Son Görülme</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $var)
                <?php
                $userinfo = \App\Models\User::where('id', '=', $var->user_id)->first();
    
                if ($userinfo) {
                    $onlinetime = $userinfo->onlinetime;
                    $time = $onlinetime / 3600;
                }
                ?>
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $userinfo->name }}</td>
                    <td>{{ $userinfo->username }}</td>
                    <td style="color: dodgerblue;">
                        {{ $userinfo->email }}
                    </td>
                    <td>{{ $userinfo->tel }}</td>
                    <td>{{ $time }}{{ ' Gün' }}</td>
                    <td>{{ $lastvizit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </main>
    

</body>

</html>
