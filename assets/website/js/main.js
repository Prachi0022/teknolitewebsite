document.addEventListener("DOMContentLoaded", () => {
  const track = document.getElementById("carousel-track");
  const prevBtn = document.getElementById("btn-prev");
  const nextBtn = document.getElementById("btn-next");

  if (!track || !prevBtn || !nextBtn) return;

  let currentIndex = 0;

  /**
   * Calculates the current structural boundaries and slides the track position
   */
  function moveCarousel() {
    const cards = track.querySelectorAll(".category-preview");
    if (cards.length === 0) return;

    // 1. Grab operational widths dynamically
    const cardWidth = cards[0].getBoundingClientRect().width;
    
    // Get the computed CSS gap spacing between cards
    const computedStyle = window.getComputedStyle(track);
    const gap = parseFloat(computedStyle.gap) || 0;

    // 2. Bound constraints checking
    const totalItems = cards.length;
    const containerWidth = track.parentElement.getBoundingClientRect().width;
    
    // Calculate total layout scroll width vs visible window container framework
    const totalTrackWidth = (cardWidth * totalItems) + (gap * (totalItems - 1));
    const maxPossibleScroll = totalTrackWidth - containerWidth;

    // If the track content is shorter than the viewport container, reset and terminate execution
    if (maxPossibleScroll <= 0) {
      track.style.transform = `translateX(0px)`;
      prevBtn.style.opacity = "0.3";
      prevBtn.style.pointerEvents = "none";
      nextBtn.style.opacity = "0.3";
      nextBtn.style.pointerEvents = "none";
      return;
    }

    // 3. Compute structural slide translate position
    let targetTranslate = currentIndex * (cardWidth + gap);

    // Prevent scrolling past blank voids at the end of the carousel array
    if (targetTranslate >= maxPossibleScroll) {
      targetTranslate = maxPossibleScroll;
      // Soft clamping to handle uneven division elements
      currentIndex = Math.ceil(maxPossibleScroll / (cardWidth + gap));
    }

    // 4. Fire hardware-accelerated movement string transition
    track.style.transform = `translateX(-${targetTranslate}px)`;

    // 5. Update Navigation Control Interactive States
    // Back arrow handler
    if (currentIndex === 0) {
      prevBtn.style.opacity = "0.3";
      prevBtn.style.pointerEvents = "none";
    } else {
      prevBtn.style.opacity = "1";
      prevBtn.style.pointerEvents = "auto";
    }

    // Forward arrow handler
    if (targetTranslate >= maxPossibleScroll) {
      nextBtn.style.opacity = "0.3";
      nextBtn.style.pointerEvents = "none";
    } else {
      nextBtn.style.opacity = "1";
      nextBtn.style.pointerEvents = "auto";
    }
  }

  /* ── EVENT LISTENER SUBSCRIPTIONS ── */

  nextBtn.addEventListener("click", () => {
    const cards = track.querySelectorAll(".category-preview");
    if (currentIndex < cards.length - 1) {
      currentIndex++;
      moveCarousel();
    }
  });

  prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      moveCarousel();
    }
  });

  // Re-calculate math calculations cleanly if a user changes device orientation or resizes viewports
  let resizeDebounceTimer;
  window.addEventListener("resize", () => {
    clearTimeout(resizeDebounceTimer);
    resizeDebounceTimer = setTimeout(() => {
      moveCarousel();
    }, 100);
  });

  // Fire initial runtime cycle to verify navigation button visibility states immediately
  moveCarousel();
});

/* =========================================
   TEKNOLITE COUNTER ANIMATION
========================================= */

document.addEventListener("DOMContentLoaded", () => {

    const counters = document.querySelectorAll(".counter");

    const runCounter = (counter) => {

        const target = parseInt(counter.getAttribute("data-target"));

        let current = 0;

        const increment = target / 120;

        const updateCounter = () => {

            current += increment;

            if(current < target){

                counter.innerText = Math.floor(current);

                requestAnimationFrame(updateCounter);

            }else{

                counter.innerText = target;
            }
        };

        updateCounter();
    };

    /* INTERSECTION OBSERVER */

    const counterObserver = new IntersectionObserver((entries) => {

        entries.forEach((entry) => {

            if(entry.isIntersecting){

                runCounter(entry.target);

                counterObserver.unobserve(entry.target);
            }
        });

    },{
        threshold:0.4
    });

    /* OBSERVE COUNTERS */

    counters.forEach((counter) => {

        counterObserver.observe(counter);

    });

});