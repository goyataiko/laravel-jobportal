@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        @include('message')
        <div class="card p-3 mb-3 text-center">
            <p>テスト用カードの番号は、以下のとおりです。CVCと有効期限は任意で入力できます。
                <br>
                カード番号：4242 4242 4242 4242<br>
                <br>
                テスト決済時に加入したメールアドレス宛に、購読感謝メールが送信されます。</p>
        </div>   
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Weekly - $20</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('pay.weekly')}}" class="card-link">
                        <button class="btn btn-success">Pay</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Montly - $60</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('pay.monthly')}}" class="card-link">
                        <button class="btn btn-success">Pay</button>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
        <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Annually - $300</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('pay.anually')}}" class="card-link">
                        <button class="btn btn-success">Pay</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection