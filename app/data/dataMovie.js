// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

DataMovie.requestMovies = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getAllMovies");
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMovieDetails = async function (id) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=getMovieDetails&id=" + id
  );
  let movie = await answer.json(); // This will be an object, not an array
  return movie;
};

export { DataMovie };
