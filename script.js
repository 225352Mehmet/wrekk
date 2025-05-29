
const songs = [
  { title: "Chill Vibes", src: "assets/song1.mp3", cover: "assets/cover1.jpg" },
  { title: "Lo-Fi Beat", src: "assets/song2.mp3", cover: "assets/cover2.jpg" },
  { title: "Night Ride", src: "assets/song3.mp3", cover: "assets/cover3.jpg" }
];

let current = 0;

function updateSong() {
  const audio = document.getElementById("audio");
  const cover = document.getElementById("cover");
  const title = document.getElementById("songTitle");

  audio.src = songs[current].src;
  cover.src = songs[current].cover;
  title.textContent = songs[current].title;
  audio.play();
}

function nextSong() {
  current = (current + 1) % songs.length;
  updateSong();
}

function prevSong() {
  current = (current - 1 + songs.length) % songs.length;
  updateSong();
}
