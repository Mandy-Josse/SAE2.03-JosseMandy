let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG
let DataProfile = {};

DataProfile.requestProfiles = async function () {
  let response = await fetch(HOST_URL + "/server/script.php?todo=readProfiles");
  let profiles = await response.json();
  return profiles;
};

export { DataProfile };
