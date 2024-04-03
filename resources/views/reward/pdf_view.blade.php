<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Danh sách giáo viên</title>
    <style>
        *{ font-family: DejaVu Sans !important;}
        h2 {
            margin-left: 370px;
        }
        .table{
            border-collapse: collapse;
            width: 100%;
        }
        .table td , .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Trường Tiểu Học A Thanh Hải</h1>
        <h5>Địa chỉ : Thôn Cổ Động ,Xã Thanh Hải,Huyện Thanh Liêm,Tỉnh Hà Nam</h5>
        <h6>Email : tieuhocthanhhai@gmail.com</h6>
        <h6>Phone :  0226 3888 039</h6>
    </div>
    <h2>Danh Sách Khen Thưởng</h2>
    <table class="table">
        <tr>
            <th>Họ và tên</th>
            <th>Lớp</th>
            <th>Học kì</th>
            <th>Hình thức khen thưởng</th>
        </tr>
            @foreach($rewards as $reward)
        <tr>
            <td>{{ $reward->student->name }}</td>
            <td>{{ $reward->classes->class_name }}</td>
            <td>{{ $reward->semester->semester_name }}</td>
            <td>{{ $reward->student_reward }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
