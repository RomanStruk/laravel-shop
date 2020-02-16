<!-- Breadcrumb Start -->
<div class="breadcrumb-area ptb-10 ptb-sm-30">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li @if (isset($index)) class="active" @endif><a  href="{{ url('/') }}">Home</a></li>
                @if (isset($shop))
                    <li class="active"><a href="{{ url('shop') }}">{{ $shop }}</a></li>
                @endif
                @if (isset($product))
                    <li><a href="{{ url('shop') }}">Shop</a></li>
                    <li class="active"><a href="">{{ $product }}</a></li>
                @endif
                @if (isset($contact))
                    <li><a href="{{ url('contact') }}">Shop</a></li>
                    <li class="active"><a href="">{{ $contact }}</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
