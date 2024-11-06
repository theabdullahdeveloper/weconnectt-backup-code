@php
$user = \App\Models\User::where('email', $senderEmail)->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset($theme->favicon) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Your Honest Review for {{ $user->name }}</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        --yellow: #FFBD13;
        --blue: #4383FF;
        --blue-d-1: #3278FF;
        --light: #F5F5F5;
        --grey: #AAA;
        --white: #FFF;
        --shadow: 8px 8px 30px rgba(0, 0, 0, .05);
    }

    body {
        background: var(--light);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 1rem;
    }

    .wrapper {
        background: var(--white);
        padding: 2rem;
        max-width: 576px;
        width: 100%;
        border-radius: .75rem;
        box-shadow: var(--shadow);
        text-align: center;
    }

    .wrapper h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .rating {
        display: flex;
        justify-content: center;
        align-items: center;
        grid-gap: .5rem;
        font-size: 2rem;
        color: var(--yellow);
        margin-bottom: 2rem;
    }

    .rating .star {
        cursor: pointer;
    }

    .rating .star.active {
        opacity: 0;
        animation: animate .5s calc(var(--i) * .1s) ease-in-out forwards;
    }

    @keyframes animate {
        0% {
            opacity: 0;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.2);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }


    .rating .star:hover {
        transform: scale(1.1);
    }

    textarea {
        width: 100%;
        background: var(--light);
        padding: 1rem;
        border-radius: .5rem;
        border: none;
        outline: none;
        resize: none;
        margin-bottom: .5rem;
    }

    .input-text {
        width: 100%;
        background: var(--light);
        padding: 1rem;
        border-radius: .5rem;
        border: none;
        outline: none;
        resize: none;
        margin-bottom: .5rem;
    }

    .btn-group {
        display: flex;
        grid-gap: .5rem;
        align-items: center;
    }

    .btn-group .btn {
        padding: .75rem 1rem;
        border-radius: .5rem;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: .875rem;
        font-weight: 500;
    }

    .btn-group .btn.submit {
        background: var(--blue);
        color: var(--white);
    }

    .btn-group .btn.submit:hover {
        background: var(--blue-d-1);
    }

    .btn-group .btn.cancel {
        background: var(--white);
        color: var(--blue);
    }

    .btn-group .btn.cancel:hover {
        background: var(--light);
    }
</style>

<body>

    <div class="wrapper">

        <h3>Write an honest review for {{ $user->company_name }}</h3>
        <form method="POST" action="{{ route('store.review') }}">
            @csrf
            <input type="hidden" name="email" value="{{$senderEmail}}">
            <input type="hidden" name="date" id="local-date">


            <div class="rating">
                <input type="number" name="rating" hidden required>
                <i class='bx bx-star star' style="--i: 0;"></i>
                <i class='bx bx-star star' style="--i: 1;"></i>
                <i class='bx bx-star star' style="--i: 2;"></i>
                <i class='bx bx-star star' style="--i: 3;"></i>
                <i class='bx bx-star star' style="--i: 4;"></i>
            </div>
            <input type="text" name="feedbacker_name" required id="feedbacker_name" class="input-text"
                placeholder="Enter your name">
            <input type="email" name="feedbacker_email" required id="feedbacker_email" class="input-text"
                placeholder="Enter your email">

            <textarea name="feedback" cols="30" rows="5" placeholder="Your honest review..." required></textarea>
            <div class="btn-group " style="float: right;">

                <button type="submit" class="btn submit ">Submit</button>

            </div>
        </form>
    </div>
    <script>

        var currentDate = new Date();
        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var formattedDate = currentDate.getDate() + "-" + monthNames[currentDate.getMonth()] + "-" + currentDate.getFullYear();
        document.getElementById("local-date").value = formattedDate;
    </script>

    <script>
        const allStar = document.querySelectorAll('.rating .star')
        const ratingValue = document.querySelector('.rating input')

        allStar.forEach((item, idx) => {
            item.addEventListener('click', function () {
                let click = 0
                ratingValue.value = idx + 1

                allStar.forEach(i => {
                    i.classList.replace('bxs-star', 'bx-star')
                    i.classList.remove('active')
                })
                for (let i = 0; i < allStar.length; i++) {
                    if (i <= idx) {
                        allStar[i].classList.replace('bx-star', 'bxs-star')
                        allStar[i].classList.add('active')
                    } else {
                        allStar[i].style.setProperty('--i', click)
                        click++
                    }
                }
            })
        })
    </script>
</body>

</html>