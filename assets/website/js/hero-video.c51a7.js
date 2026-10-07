document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".js-hero-media").forEach((mediaElement) => {
    const video = mediaElement.querySelector("video#hero-video");
    if (!video) return;

    const toggleButton = mediaElement.querySelector(".js-hero-toggle");
    toggleButton?.addEventListener("click", () => {
      if (video.paused) {
        video.play();
        mediaElement.setAttribute("data-video-action", "pause");
      } else {
        video.pause();
        mediaElement.setAttribute("data-video-action", "play");
      }
    });

    // Optional: Sync the `data-video-action` based on play and pause events
    video.addEventListener("play", () => {
      mediaElement.setAttribute("data-video-action", "pause");
    });

    video.addEventListener("pause", () => {
      mediaElement.setAttribute("data-video-action", "play");
    });
  });
});
