import AlternativeButton from "./global/AlternativeButton"
import ErrorMessage from "./global/ErrorMessage";
import FormInput from "./global/FormInput"
import PrimaryButton from "./global/PrimaryButton"
import SecondaryButton from "./global/SecondaryButton"
import { Link } from "@inertiajs/react";
import { useState } from "react";

export default function Login(){
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [emailError, setEmailError] = useState('');
    const [passwordError, setPasswordError] = useState('');

    return(
        <div className="container mx-auto">
            <h1 className="mb-10 text-2xl">Bienvenido de vuelta!</h1>
            <h1 className="grid justify-center text-2xl mb-2">Iniciar sesión</h1>

            <div className="flex flex-col mx-4 mb-14">
                <div>
                    <FormInput placeholder="Email" type="email" setter={setEmail}/>
                    <ErrorMessage message={emailError}/>
                </div>

                <div>
                    <FormInput placeholder="Password" type="password" setter={setPassword}/>
                    <ErrorMessage message={passwordError}/>
                </div>
            </div>

            <div className="flex flex-col mx-4 mb-4 space-y-4">
                <PrimaryButton text="Iniciar sesión" action={loginRequest}/>
                <SecondaryButton text="Olvidé mi contraseña"/>
                <Link href="/register" as="button" type="button" className="border border-white py-2 rounded-full">
                    Crear cuenta
                </Link>
            </div>
        </div>
    )

    function loginRequest(){
        fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors){
                setEmailError(data.errors.email);
                setPasswordError(data.errors.password);
                return;
            }
            localStorage.setItem('token', data.token);
            window.location = '/teams';
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
}
