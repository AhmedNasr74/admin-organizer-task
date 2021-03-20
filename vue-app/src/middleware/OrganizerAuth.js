export default function OrganizerAuth({ next, router }) {
  let organizer = JSON.parse(localStorage.getItem("organizer"));
  if (organizer == null) {
    router.push({ name: "OrganizerLogin" });
  } else {
    if (
      organizer.token == undefined ||
      organizer.token == null ||
      organizer.token == ""
    )
      router.push({ name: "OrganizerLogin" });
    else return next();
  }
}
