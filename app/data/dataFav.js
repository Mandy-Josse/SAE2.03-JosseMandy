// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataFav = {};

DataFav.requestFavorites = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getFav" );
  let favs = await answer.json();
  return favs;
};

DataFav.requestAddFavorite = async function (id_profile, id_film) {
  let answer = await fetch(
    HOST_URL + `/server/script.php?todo=addFav&id_profile=${id_profile}&id_film=${id_film}`);
  let favArray = await answer.json();
  return favArray; 
};




DataFav.requestDeleteFavorite = async function (id) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=delFav&id=" + id);
  let data = await answer.json();
  return data;


};
export { DataFav };
