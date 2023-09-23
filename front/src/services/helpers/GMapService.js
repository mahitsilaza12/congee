import axios from 'axios'

const GMAP_GEOCODE_API  = 'https://maps.googleapis.com/maps/api/geocode/json'
const GMAP_KEY          = process.env.GMAP_KEY

const GMapService = {
    getAddressLocation : async function(address){
        let location = await axios.get(GMAP_GEOCODE_API, {
            params: {
                address : address,
                key     : GMAP_KEY
            }
        }).then(
            (response) => {
                return response.data
            }
        )
        return location
    }
}


export default GMapService;