export default function({route, $auth, redirect}){
  if (route.fullPath !== "/verify" && route.fullPath !== "/" && route.fullPath !== "/thanks") {
    if ($auth.user) {
      if (! $auth.user.email_verified_at) {
        return redirect("verify");
      }
    }
  }
}