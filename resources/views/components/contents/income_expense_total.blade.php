 <div class="row d-flex justify-content-between">
    <div class="col-lg-6">
   {{ __('common.Total Rows')}} : {{$records->total()}}
    </div>
        <div class="col-lg-6 d-flex justify-content-end">
       {{  __('common.Total Amount')   }} : {{number_format($totalAmount,2)}}
    </div>
</div>
