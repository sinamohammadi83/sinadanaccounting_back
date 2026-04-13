<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<div class="bg-gray-200 w-full h-screen flex justify-center items-center">
    <div class="bg-white w-[400px] rounded-3xl h-[350px] shadow-lg shadow-black-500/50 ">
        <div class=" flex justify-center mt-5">
            <img src="https://navidrayan.ir/wp-content/uploads/2023/10/Untitled-2-331x300.jpg" width="90px" alt="">
        </div>
        <form class="flex flex-col items-center mt-4" action="{{route("AdminAuth.con")}}" method="post">
            <span><strong>حسابداری نوید رایان</strong></span>
            @csrf
            <input type="text" class="bg-gray-300 rounded p-1 mt-5 w-7/12 outline-none pl-9" placeholder="نام کاربری" name="username" id="">
            <input type="password" class="bg-gray-300 rounded p-1 mt-5 w-7/12 outline-none pl-9" placeholder="رمز عبور" name="password" id="">
            <button type="submit" class="m-5 bg-blue-600 text-white mt-8 w-7/12 p-1 rounded">ورود به حساب کاربری</button>

        </form>
    </div>
</div>
</body>
</html>
