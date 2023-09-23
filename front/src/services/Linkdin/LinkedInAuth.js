import axios from "axios";

const API_URL = "https://www.linkedin.com/oauth/v2/authorization"
//const token_exchange = "https://www.linkedin.com/oauth/v2/accessToken"
const token_exchange = "/api/linkedinoauth/accessToken"
const client_id      = "86xzbj67hbklj5"
const client_secret  = "DQqDq7ZlKoeqDkth"
//const redirect_uri   = "http://localhost:8888/en/organization"
const response_type  = "code"
const scope          ="r_liteprofile r_emailaddress"

const LinkedinAuth = {
    onLoadSdk : function(redirect_uri){
       let url = new URL(API_URL)
       url.searchParams.append('client_id'     , client_id)
       url.searchParams.append('redirect_uri'  , redirect_uri)
       url.searchParams.append('response_type' , response_type)
       url.searchParams.append('scope'         , scope)
 
       window.location.href = url
       
    },
    getUserInfos : function(code, redirect_uri){
       return  axios.post(
          token_exchange, 
          {
             grant_type    : 'authorization_code',
             code          : code ,
             redirect_uri  : redirect_uri,
             client_id     : client_id,
             client_secret : client_secret
          }
       )
    }
 
 }
 
 export default LinkedinAuth