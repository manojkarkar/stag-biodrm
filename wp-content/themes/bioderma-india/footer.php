<footer class="footer content-info">
  <section class="primary-bg newsletter">
  <article class="wrap">
    <p class="newsletter__p"><strong>Sign up!</strong> Get news, exclusive promotions, skincare tips and much more!</p>
    <form class="newsletter__form nowrap">
      <input class="newsletter__input" name="email" placeholder="email@address.com" type="text">
      <button class="btn btn--newsletter newsletter__btn js-newsletter-btn" data-popin="newsletter">
        <span class="btn__label">Subscribe</span>
        <span class="btn__loading loading">
          <span class="loading__b1"></span>
          <span class="loading__b2"></span>
          <span class="loading__b3"></span>
        </span>
        <span class="btn__success"><svg width='20' height='12'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-checkmark' /></svg></span>
      </button>
    </form>
  </article>
</section>

<div class="grid grid--center popin-wrapper" data-popin="newsletter">
  <div class="popin grid">
    <span class="popin__close"><svg width="19" height="19"><use xlink:href="<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-close" /></svg></span>
    <div class="popin__content" id='popup__content'>
      <p class="h3 spacing-bot-medium">Thank you for your subscription!</p>
      <p>Tell us more about yourself to get customized offers.</p>
      <a class="btn" href="" target="_blank">Complete my information</a>
    </div>
  </div>
  <div class="overlay"></div>
</div>
  <section class="footer__social">
  <nav class="wrap grid grid--big-icons grid--around">
    <!--    <a class="accent-bold" href="<?php echo get_site_url();?>/store-locator/">-->
    <!--  <span class="btn-circle"><svg width='24' height='30'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-pin' /></svg></span>-->
    <!--  <span class="btn-circle-label">Store locator</span>-->
    <!--</a>-->
     <!-- <a class="accent-bold" href="<?php echo get_site_url();?>/laboratory/">
      <span class="btn-circle"><svg width='45' height='40'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-laboratory' /></svg></span>
      <span class="btn-circle-label">Laboratory</span>
    </a> -->
    <a class="accent-bold" href="https://www.facebook.com/BIODERMAIndia/" target="_blank">
      <span class="btn-circle"><svg width='22' height='26'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-facebook' /></svg></span>
      <span class="btn-circle-label">Follow us on Facebook</span>
    </a>
    <a class="accent-bold" href="https://twitter.com/BiodermaIndia" target="_blank">
      <span class="btn-circle"><svg width='24' height='30'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-twitter' /></svg></span>
      <span class="btn-circle-label">Follow us on Twitter</span>
    </a>
    <a class="accent-bold" href="https://www.instagram.com/biodermaindia/" target="_blank">
      <span class="btn-circle"><svg width='24' height='30'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-instagram' /></svg></span>
      <span class="btn-circle-label">Follow us on Instagram</span>
    </a>
     <a class="accent-bold" href="https://www.youtube.com/channel/UCDYcHTeaMptE9a7BAPFdveQ" target="_blank">
      <span class="btn-circle"><svg width='35' height='35'><svg id="icn-youtube" viewBox="0 0 60.6 57.3">
  <path d="m38.204 28.662-7.927-5.947c-.04-.03-.082-.059-.124-.086-1.232-.788-2.794-.838-4.075-.137-1.282.702-2.078 2.047-2.078 3.508v12c0 1.461.796 2.806 2.078 3.508.6.329 1.261.492 1.922.492.75 0 1.498-.21 2.153-.629.042-.027.084-.056.124-.086l7.927-5.947c1.127-.742 1.796-1.983 1.796-3.338s-.669-2.596-1.796-3.338zm-2.344 3.434-7.86 5.897v-11.986l7.859 5.896c.046.035.093.067.141.097-.048.03-.095.062-.14.096z"></path><path d="m46 14h-28c-5.514 0-10 4.486-10 10v16c0 5.514 4.486 10 10 10h28c5.514 0 10-4.486 10-10v-16c0-5.514-4.486-10-10-10zm6 26c0 3.309-2.691 6-6 6h-28c-3.309 0-6-2.691-6-6v-16c0-3.309 2.691-6 6-6h28c3.309 0 6 2.691 6 6z"></path>
</svg></svg></span>
      <span class="btn-circle-label">Subscribe us on Youtube</span>
    </a>
    <!-- <a class="accent-bold" href="mailto:h.parab@bioderma-india.in">
      <span class="btn-circle"><svg width='24' height='30'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-email' /></svg></span>
      <span class="btn-circle-label">Contact us</span>
    </a> -->
      </nav>
</section>
  <section class="footer__foot wrap grid grid--vcenter">
  <p class="g-item">&copy; <?php echo date('Y');?> Laboratoire Bioderma. All rights reserved.</p>
  <nav class="g-item">
  <ul id="menu-footer-en" class="reset grid-inline">
    <li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20"><a href="<?php echo get_site_url();?>/bioderma-teams/">Our Team</a></li>
    <li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="<?php echo get_site_url();?>/bioderma-around-the-world/">Bioderma Around the World</a></li>
    <li id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22"><a href="<?php echo get_site_url();?>/privacy-policy/">Privacy policy</a></li>
    <li id="menu-item-23" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-23"><a href="<?php echo get_site_url();?>/terms-conditions/">Terms &amp; conditions</a></li>
    <li id="menu-item-24" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24"><a href="mailto:h.parab@bioderma-india.in">Contact us</a></li>
   <!--  <li id="menu-item-25" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25"><a href="<?php echo get_site_url();?>/site-map/">Site map</a></li> -->
</ul>
  </nav>
  <p class="g-item footer__foot-naos">
    <a href="https://naos.com/en/" target="_blank"><img width="160" src="<?php bloginfo("template_url"); ?>/images/logos/naos_new.png" alt="NAOS"></a>
    <span>Bioderma is a NAOS brand.</span>
  </p>

</section>
</footer>
 <!--  <script type='text/javascript' src='<?php bloginfo("template_url"); ?>/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script> -->
<script  src='<?php bloginfo("template_url"); ?>/scripts/lib.js'></script>
<?php
wp_enqueue_script( 
       'tq_subscribe', 
       get_template_directory_uri() . '/scripts/main.js',
array( 'jquery' ) );

wp_localize_script('tq_subscribe', 'b19s2k7t8q6', array(
        'b10d3714' => admin_url('admin-ajax.php'),
        's1k014t2' => wp_create_nonce('bioderma-india'), )
);
?>
<script>
  jQuery(document).ready(function($) {
   jQuery(".list--inline-bullets li").append('<span class="list__bullet branding"><svg width="17" height="17"><use xlink:href="<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span>');
  });
</script>
<!-- Start of Async Drift Code -->
<script>
"use strict";

!function() {
  var t = window.driftt = window.drift = window.driftt || [];
  if (!t.init) {
    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
    t.factory = function(e) {
      return function() {
        var n = Array.prototype.slice.call(arguments);
        return n.unshift(e), t.push(n), t;
      };
    }, t.methods.forEach(function(e) {
      t[e] = t.factory(e);
    }), t.load = function(t) {
      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
      var i = document.getElementsByTagName("script")[0];
      i.parentNode.insertBefore(o, i);
    };
  }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('w5f4fci2nfza');
</script>
<!-- End of Async Drift Code -->
<?php wp_footer(); ?>
</body>
</html>
