/**
 * Template Name: Mamba
 * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
 * Updated: Aug 07 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
      const selectBody = document.querySelector("body");
      const selectHeader = document.querySelector("#header");
      if (
        !selectHeader ||
        (!selectHeader.classList.contains("scroll-up-sticky") &&
          !selectHeader.classList.contains("sticky-top") &&
          !selectHeader.classList.contains("fixed-top"))
      )
        return;
      window.scrollY > 100
        ? selectBody.classList.add("scrolled")
        : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    toggleScrolled(); // Initial call to set state

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");
    if (mobileNavToggleBtn) {
      mobileNavToggleBtn.addEventListener("click", function () {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
      });
    }

    /**
     * Preloader
     */
    const preloader = document.querySelector("#preloader");
    if (preloader) {
      preloader.style.display = "none"; // Hide preloader after DOM loads
    }

    /**
     * Scroll top button
     */
    const scrollTop = document.querySelector(".scroll-top");
    if (scrollTop) {
      function toggleScrollTop() {
        window.scrollY > 100
          ? scrollTop.classList.add("active")
          : scrollTop.classList.remove("active");
      }

      scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
      });

      toggleScrollTop();
      document.addEventListener("scroll", toggleScrollTop);
    }

    /**
     * Handle section rendering for #about and #service
     */
    const aboutSection = document.querySelector("#About");
    const serviceSection = document.querySelector("#Service");
    if (aboutSection && serviceSection) {
      // Simulate AOS (Animate on Scroll) initialization
      aboutSection.setAttribute("data-aos", "fade-up");
      serviceSection.setAttribute("data-aos", "fade-up");
    }

    /**
     * Book Pickup and Track Forms Toggle
     */
    const bookPickupButton = document.querySelector(".quote-btn");
    const trackButton = document.querySelector(".track-btn");
    const quoteForm = document.querySelector(".quote-form");
    const trackForm = document.querySelector(".track-form");

    if (quoteForm && trackForm) {
      quoteForm.style.display = "none";
      trackForm.style.display = "none";

      if (bookPickupButton) {
        bookPickupButton.addEventListener("click", function () {
          quoteForm.style.display = "block";
          trackForm.style.display = "none";
        });
      }

      if (trackButton) {
        trackButton.addEventListener("click", function () {
          trackForm.style.display = "block";
          quoteForm.style.display = "none";
        });
      }
    }

    /**
     * Ensure proper AOS initialization
     */
    if (typeof AOS !== "undefined") {
      AOS.init(); // Reinitialize AOS if available
    }
  });
})();
