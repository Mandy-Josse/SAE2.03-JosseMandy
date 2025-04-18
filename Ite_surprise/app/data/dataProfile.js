let HOST_URL = "https://josse-sae203.mmi-limoges.fr/Ite_surprise/"; // CHANGE THIS TO MATCH YOUR CONFIG
let DataProfile = {};

DataProfile.requestProfiles = async function () {
  let response = await fetch(HOST_URL + "/server/script.php?todo=readProfiles");
  let profiles = await response.json();
  return profiles;
};

export { DataProfile };
