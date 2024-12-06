import AlternativeButton from "./global/AlternativeButton";
import FormInput from "./global/FormInput";
import PrimaryButton from "./global/PrimaryButton";

export default function CreateGroup() {

    function navigateToCreateGroup() {
        window.location.href = "/team/new";
    }

    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Equipos</h1>
                <div className="flex flex-col mx-4">
                    <p className="text-sm">Unirse a un equipo existente</p>
                </div>
                <div className="flex flex-col mx-4 mb-4 space-y-4">
                    <FormInput placeholder="Ingresa el código del grupo"/>
                    <PrimaryButton text="Ingresar"/>
                    <AlternativeButton action={() => navigateToCreateGroup()} text="Crear un nuevo grupo"/>
                </div>
        </div>
    )
}
