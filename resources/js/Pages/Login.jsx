import AlternativeButton from "./global/AlternativeButton"
import FormInput from "./global/FormInput"
import PrimaryButton from "./global/PrimaryButton"
import SecondaryButton from "./global/SecondaryButton"

export default function Login(){

    return(
        <div className="container mx-auto ">
            <h1 className="mb-10 text-2xl">Bienvenido de vuelta!</h1>
            <h1 className="grid justify-center text-2xl mb-2">Iniciar sesión</h1>

            <div className="flex flex-col mx-4 mb-14">
                <FormInput placeholder="Email"/>
                <FormInput placeholder="Password" />
            </div>

            <div className="flex flex-col mx-4 mb-4 space-y-4">
                <PrimaryButton text="Iniciar sesión"/>
                <SecondaryButton text="Olvidé mi contraseña"/>
                <AlternativeButton text="Crear cuenta"/>
            </div>
        </div>
    )
}
