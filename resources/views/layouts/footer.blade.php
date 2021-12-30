<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('images/logo.svg') }}" alt=""></a>
                    </div>
                    <ul>
                        <li><i class="fas fa-address-card"></i> {{ $setup->address }}</li>
                        <li><i class="fas fa-phone-alt"></i> {{ $setup->telephone }}</li>
                        <li><i class="fas fa-fax"></i> {{ $setup->fax }}</li>
                        <li><i class="fas fa-user"></i> 主要聯絡人：{{ $setup->contact_person1 }}</li>
                        <li>{{ $setup->contact_email1 }}</li>
                        <li><i class="fas fa-user-circle"></i> 次要聯絡人：{{ $setup->contact_person2 }}</li>
                        <li>{{ $setup->contact_email2 }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>有用連結</h6>
                    <ul>
                        <li><a href="https://www.chcg.gov.tw" target="_blank">彰化縣政府</a></li>
                        <li><a href="https://education.chcg.gov.tw/00home/index1.asp" target="_blank">彰化縣政府教育處</a></li>
                        <li><a href="https://newboe.chc.edu.tw" target="_blank">彰化縣政府教育處新雲端</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            程式設計及版權：ET Wang <i class="fa fa-envelope"></i> wangchifu@hdes.chc.edu.tw
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
