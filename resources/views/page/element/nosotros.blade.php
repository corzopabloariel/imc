<div style="padding-top: 50px; padding-bottom: 50px" class="wrapper-nosotros container" id="scroll-nosotros">
    <h4 style="padding-bottom:25px" class="text-uppercase text-center title">{{trans('words.menu.us')}}</h4>
    <div class="text-justify" style="color:#595959">
        {!! $nosotros["texto"] !!}
    </div>
</div>
<div style="padding: 50px 0;" class="wrapper-mercado container">
    <h4 style="padding-bottom:25px" class="text-uppercase text-center title">{{trans('words.menu.market')}}</h4>
    {!! $nosotros["mercado"] !!}
</div>