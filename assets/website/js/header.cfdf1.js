class Header {
  #e = 150;
  #t = 150;
  constructor() {
    (this.header = document.querySelector(".js-header")),
      this.header &&
        (window.matchMedia("(max-width: 1023px)").matches && (this.#e = 0),
        (this.sentinel = document.querySelector(".js-sentinel")),
        (this.headerTop = this.header.querySelector(".js-header__top")),
        (this.toggle = this.header.querySelector(".js-header__toggle")),
        (this.switchToggle = this.header.querySelector(".js-switch__toggle")),
        (this.headerNav = this.header.querySelector(".js-header-nav")),
        (this.headerNavItems = this.header.querySelectorAll(
          ".js-header-nav__item"
        )),
        (this.notice = document.querySelector(".notice-bar")),
        (this.headerBackground = document.querySelector(
          ".js-header-background"
        )));
  }
  init() {
    this.header &&
      (window.IntersectionObserver
        ? this.initIntersectionObserver()
        : this.initFallbackScrollListener(),
      this.watchNavItems(),
      this.watchToggle(),
      this.watchBackgroundClick());
  }
  initIntersectionObserver = () => {
    new IntersectionObserver((e) => {
      const t = e[0].isIntersecting ? "static" : "sticky";
      this.header.setAttribute("data-position", t);
    }).observe(this.sentinel);
  };
  initFallbackScrollListener = () => {
    window.addEventListener("scroll", () => {
      const e = window.scrollY > 0 ? "static" : "sticky";
      this.header.setAttribute("data-position", e);
    });
  };
  watchNavItems() {
    this.headerNavItems.forEach((e) => {
      e.addEventListener("click", (t) => {
        t.target.classList.contains("header-nav__link") &&
          e.dataset.sublinks > 0 &&
          (t.preventDefault(),
          this.toggleNavItem(e),
          e.querySelector("a")?.focus());
      });
    });
  }
  activateNavItem(e) {
    0 != e.dataset.sublinks &&
      (clearTimeout(this.deactivateTimeout),
      e.classList.add("header-nav__item--activating"),
      this.headerBackground?.classList.add("header-background--activating"),
      (this.activateTimeout = setTimeout(() => {
        e.classList.add("header-nav__item--active"),
          this.headerBackground?.classList.add("header-background--active");
      }, this.#e)),
      Astro._search.deactivate());
  }
  deactivateNavItem() {
    clearTimeout(this.activateTimeout),
      this.headerNavItems.forEach((e) =>
        e.classList.remove("header-nav__item--active")
      ),
      this.headerBackground?.classList.remove("header-background--active"),
      (this.deactivateTimeout = setTimeout(() => {
        this.headerNavItems.forEach((e) =>
          e.classList.remove("header-nav__item--activating")
        ),
          this.headerBackground?.classList.remove(
            "header-background--activating"
          ),
          this.header.removeAttribute("active-item");
      }, this.#e));
  }
  toggleNavItem(e) {
    if (e.classList.contains("header-nav__item--active"))
      this.deactivateNavItem();
    else {
      this.header.querySelector(".header-nav__item--active") &&
        this.deactivateNavItem(),
        setTimeout(() => {
          this.activateNavItem(e);
        }, this.#e);
    }
  }
  watchToggle() {
    this.toggle?.addEventListener("click", () => {
      this.header.classList.contains("header--activating")
        ? this.deactivate()
        : this.activate();
    });
  }
  activate() {
    this.header.classList.add("header--activating"),
      document.documentElement.classList.add("lock-scroll"),
      (this.activateTimeout = setTimeout(() => {
        this.header.classList.add("header--active");
      }, this.#t)),
      Astro._search.deactivate();
  }
  deactivate() {
    document.documentElement.classList.remove("lock-scroll"),
      this.header.classList.remove("header--active"),
      (this.deactivateTimeout = setTimeout(() => {
        this.header.classList.remove("header--activating");
      }, this.#t));
  }
  watchBackgroundClick() {
    this.headerBackground?.addEventListener(
      "click",
      this.deactivateNavItem.bind(this)
    );
  }
}
document.addEventListener("DOMContentLoaded", () => {
  const e = new Header();
  e.init(), (Astro._header = e);
});
//# sourceMappingURL=https://assets.astrolighting.com/static/maps/js/header.js.7c0e8.map
