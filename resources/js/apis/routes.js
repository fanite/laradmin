import Axios from "@/lib/axios";

export async function userRoutes(params) {
  Axios.get("/routes/");
}
