let HOST_URL = "https://mmi.unilim.fr/~josse10/SAE2.03-JosseMandy"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataProfile = {};

DataProfile.add = async function (fdata) {
  let config = {
    method: "POST",
    body: fdata,
  };

  let answer = await fetch(HOST_URL + "/server/script.php?todo=addProfile", config);
  let data = await answer.json();
  return data;
};

DataProfile.update = async function (fdata, id) {
  let config = {
    method: "POST",
    body: fdata,
  };

  let answer = await fetch(HOST_URL + "/server/script.php?todo=updateProfile&id=" + id, config);
  let data = await answer.json();
  return data;
};

DataProfile.requestProfiles = async function () {
  let response = await fetch(HOST_URL + "/server/script.php?todo=readProfiles");
  let profiles = await response.json();
  return profiles;
};

export { DataProfile };
