// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://josse-sae203.mmi-limoges.fr/Ite_surprise/"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataFav = {};

DataFav.requestFavorites = async function (id_profile) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getFav&id=" + id_profile);
  let favs = await answer.json();
  return favs;
};

DataFav.requestAddFavorite = async function (id_profile, id_film ) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=addFav&id_profile=" + id_profile + "&id_film=" + id_film);
  let favArray = await answer.json();
  return favArray; 
};


DataFav.requestDeleteFavorite = async function (id_fav, id_profile) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=delFav&id_fav=" + id_fav + "&id_profile=" + id_profile);
  let data = await answer.json();
  return data;
};


export { DataFav };
