class WidgetHandlerClass extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        countdown: '.countdown',
        days: '.countdown__item:nth-child(1) .countdown__item-number',
        hours: '.countdown__item:nth-child(2) .countdown__item-number',
        mins: '.countdown__item:nth-child(3) .countdown__item-number',
        secs: '.countdown__item:nth-child(4) .countdown__item-number'
      }
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    return {
      $countdown: this.$element.find(selectors.countdown),
      $days: this.$element.find(selectors.days),
      $hours: this.$element.find(selectors.hours),
      $mins: this.$element.find(selectors.mins),
      $secs: this.$element.find(selectors.secs)
    };
  }

  bindEvents() {
    this.timestamp = this.elements.$countdown.data('timestamp');
    this.targetDate = new Date(this.timestamp);

    this.tick();
    setInterval(this.tick.bind(this), 1000);
  }

  tick() {
    let now = new Date();

    let diff = this.targetDate - now;

    let days = Math.floor(diff / 1000 / 60 / 60 / 24);
    diff -= days * 1000 * 60 * 60 * 24;

    let hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;

    let mins = Math.floor(diff / 1000 / 60);
    diff -= mins * 1000 * 60;

    let secs = Math.floor(diff / 1000);

    this.elements.$days.text(days);
    this.elements.$hours.text(hours);
    this.elements.$mins.text(mins);
    this.elements.$secs.text(secs);
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(WidgetHandlerClass, {
      $element
    });
  };

  elementorFrontend.hooks.addAction('frontend/element_ready/ad-system.default', addHandler);
});
