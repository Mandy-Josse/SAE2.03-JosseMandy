// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

DataMovie.add = async function () {
  let answer = await fetch(HOST_URL + "/sever/script.php?todo=addMovie");
  let addmovies = await answer.json();
  return addmovies;
};

export { DataMovie };
