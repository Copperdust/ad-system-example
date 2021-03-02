<div class="ad-system">
  <div class="ad-system__container">
    <figure class="ad-system__image" style="background-image: url('<?php echo ElementorAdSystem::plugins_url('/static/images/player.png') ?>')"></figure>
    <div class="ad-system__center-wrapper">
      <div class="ad-system__countdown-wrapper">
        <div class="countdown" data-timestamp="<?php echo $timestamp ?>">
          <div class="countdown__item">
            <span class="countdown__item-text">DAYS</span>
            <span class="countdown__item-number">01</span>
          </div>
          <div class="countdown__item">
            <span class="countdown__item-text">HOURS</span>
            <span class="countdown__item-number">23</span>
          </div>
          <div class="countdown__item">
            <span class="countdown__item-text">MIN</span>
            <span class="countdown__item-number">55</span>
          </div>
          <div class="countdown__item">
            <span class="countdown__item-text">SEC</span>
            <span class="countdown__item-number">32</span>
          </div>
        </div>
        <div class="ad-system__countdown-text">Remaining Time To Place Bet</div>
      </div>
      <div class="ad-system__text">
        <div class="ad-system__title"><?php echo $settings['title'] ?: 'Edit Me' ?></div>
        <div class="ad-system__encourage">
          Hurry Up! <b>25</b> people have placed this bet
        </div>
      </div>
    </div>
    <div class="ad-system__right-wrapper">
      <div class="ad-system__button-wrapper">
        <button class="ad-system-button">BET & WIN</button>
      </div>
      <div class="ad-system__trusted">Trusted Sportsbetting.ag</div>
    </div>
  </div>
</div>
