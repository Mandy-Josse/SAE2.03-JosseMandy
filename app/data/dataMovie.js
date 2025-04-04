// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy/"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

DataMovie.request = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies");
  let movies = await answer.json();
  return movies;
};

export { DataMovie };
