// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

DataMovie.requestMovies = async function (age) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getAllMovies&age=" + age);
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMovieDetails = async function (id) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=getMovieDetails&id=" + id);
  let movieArray = await answer.json();
  return movieArray[0]; 
};

DataMovie.requestGroupedMovies = async function (data1) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=readMoviesGrouped&data=" + data1);
  let data = await answer.json();
  return data;


};
export { DataMovie };
