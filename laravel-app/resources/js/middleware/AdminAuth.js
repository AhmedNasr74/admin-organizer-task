export default function AdminAuth({ next, router }) {
  let admin = JSON.parse(localStorage.getItem("admin"));
  if (admin == null) {
    admin = {}
  }
  if (admin.token == undefined || admin.token == null || admin.token == "")
    router.push({ name: "AdminLogin" });
  else return next();
}
