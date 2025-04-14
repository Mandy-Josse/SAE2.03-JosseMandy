// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataFav = {};

DataFav.requestFavorites = async function (age) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getFav" );
  let movies = await answer.json();
  return movies;
};

DataFav.requestAddFavorite = async function (id) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=addFav&id=" + id);
  let movieArray = await answer.json();
  return movieArray[0]; 
};

DataFav.requestDeleteFavorite = async function () {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=delFav&id=" + id);
  let data = await answer.json();
  return data;


};
export { DataFav };
