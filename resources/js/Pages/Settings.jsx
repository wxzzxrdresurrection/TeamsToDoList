import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faRightFromBracket } from "@fortawesome/free-solid-svg-icons/faRightFromBracket";

export default function Settings(){
    function logout(){
        fetch('/api/auth/logout', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        }).then(response => {
            if(response.ok){
                window.location.href = '/';
            }
        });
    }

    return(
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Menu</h1>
            <div className="flex border-y border-zinc-700 p-2 justify-between"
            onClick={() => logout()}>
                <p>Cerrar sesión</p>
                <FontAwesomeIcon icon={faRightFromBracket} className="text-white h-5"/>
            </div>
        </div>
    )
}
