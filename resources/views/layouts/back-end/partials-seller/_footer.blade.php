{{-- <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer> --}}

<div class="footer">
    <div class="row justify-content-between align-items-center">
        <div class="col">
            {{-- <p class="font-size-sm mb-0">
                &copy; {{\App\Model\BusinessSetting::where(['type'=>'company_name'])->first()->value}}. <span
                    class="d-none d-sm-inline-block">{{\App\Model\BusinessSetting::where(['type'=>'company_copyright_text'])->first()->value}}</span>
            </p> --}}
        </div>
        <div class="col-auto">
            <div class="d-flex justify-content-end">
                <!-- List Dot -->
                <ul class="list-inline list-separator">
                    <span>Copyright &copy; {{url('/')}} {{date('Y')}}</span>
                </ul>
                <!-- End List Dot -->
            </div>
        </div>
    </div>
</div>
