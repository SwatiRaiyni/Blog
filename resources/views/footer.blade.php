<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 footer-widget">
                    <a href="/{{app()->getLocale()}}/userpost" title="Helper Hand">
                        <img src="https://www.freeiconspng.com/uploads/red-blogger-logo-icon-png-17.png" width="100">
                    </a>
                </div>
                <div class="col-lg-8 footer-widget">
                    <ul class="footer-navigation d-flex justify-content-center">
                        <li>

                            <a href="/{{app()->getLocale()}}/userpost" title="Home">{{__('msg.blog')}}</a>

                        </li>
                        <li>
                            @if(app()->getLocale() == 'hi')
                            <a href="#" onclick="cms(7)" title="About">{{__('msg.About us')}}</a>
                            @else
                            <a href="#" onclick="cms(1)" title="About">{{__('msg.About us')}}</a>
                            @endif
                        </li>
                        <li>
                            @if(app()->getLocale() == 'hi')
                            <a href="#" onclick="cms(10)" title="Terms and condition">{{__('msg.Terms and condition')}}</a>
                            @else
                            <a href="#" onclick="cms(6)" title="Terms and condition">{{__('msg.Terms and condition')}}</a>
                            @endif
                        </li>
                        <li>
                            @if(app()->getLocale() == 'hi')
                            <a href="#" onclick="cms(9)" title="Privacy and Policy">{{__('msg.Privacy and policy')}}</a>
                            @else
                            <a href="#" onclick="cms(5)" title="Privacy and Policy">{{__('msg.Privacy and policy')}}</a>
                            @endif
                        </li>

                    </ul>
                </div>
                <div class="col-lg-2 footer-widget">
                    <ul class="social-media-list d-flex justify-content-end">
                        <li>
                            <a href="#" target="_blank" title="Facebook">
                                <img src="/images/facebook.png" alt="Facebook">
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank" title="Instagram">
                                <img src="/images/ic-instagram.png" alt="Instagram">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>

<style>
    /*footer section*/
/*footer*/

</style>
