import AlternativeButton from "./global/AlternativeButton";
import FormInput from "./global/FormInput";
import PrimaryButton from "./global/PrimaryButton";

export default function CreateGroup() {
    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center mb-8">Groups</h1>
                <div className="flex flex-col mx-4">
                    <p className="text-sm">Unirse a un grupo existente</p>
                </div>
                <div className="flex flex-col mx-4 mb-4 space-y-4">
                    <FormInput placeholder="Ingresa el código del grupo" />
                    <PrimaryButton text="Ingresar"/>
                    <AlternativeButton text="Crear un nuevo grupo"/>
                </div>
        </div>
    )
}
