// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataFav = {};

DataFav.requestFavorites = async function (id_profile) {
  console.log(id_profile)
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getFav&id=" + id_profile);
  let favs = await answer.json();
  return favs;
};

DataFav.requestAddFavorite = async function (id) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=addFav&id=" + id);
  let favArray = await answer.json();
  return favArray[0]; 
};

DataFav.requestDeleteFavorite = async function (id_fav) {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=delFav&id=" + id_fav);
  let data = await answer.json();
  return data;


};
export { DataFav };
