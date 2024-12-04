import { Alert } from "@mui/material";
import FormInput from "./global/FormInput";
import PrimaryButton from "./global/PrimaryButton";
import { Link } from "@inertiajs/react";
import { useState } from "react";
import ErrorMessage from "./global/ErrorMessage";
import Modal from "@mui/material/Modal";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";

const style = {
    position: "absolute",
    top: "50%",
    left: "50%",
    transform: "translate(-50%, -50%)",
    width: "80%",
    bgcolor: "black",
    border: "1px solid #fff",
    boxShadow: 24,
    p: 4,
};

export default function () {
    const [open, setOpen] = useState(false);
    const [message, setMessage] = useState("");
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [password_confirmation, setPasswordConfirmation] = useState("");
    const [error, setError] = useState(true);
    const [usernameError, setUsernameError] = useState("");
    const [emailError, setEmailError] = useState("");
    const [passwordError, setPasswordError] = useState("");
    const [passwordConfirmationError, setPasswordConfirmationError] =
        useState("");
    const handleOpen = () => setOpen(true);
    const handleClose = () => {
        setOpen(false);
        window.location.href = "/";
    };

    return (
        <div className="container mx-auto" dusk="container">
            <div hidden={error}>
                <Alert variant="outlined" severity="error">
                    Las contraseñas no coinciden
                </Alert>
            </div>
            <h1 className="grid justify-center text-4xl mt-20">
                Crea tu cuenta
            </h1>
            <div className="flex flex-col space-y-4 mx-4 my-4">
                <div>
                    <FormInput
                        placeholder="Usuario"
                        setter={setUsername}
                        name="username"
                    />
                    <ErrorMessage message={usernameError} />
                </div>
                <div>
                    <FormInput
                        placeholder="Correo"
                        type="email"
                        setter={setEmail}
                        name="email"
                    />
                    <ErrorMessage message={emailError} />
                </div>
                <div>
                    <FormInput
                        placeholder="Contraseña"
                        type="password"
                        setter={setPassword}
                        name="password"
                    />
                    <ErrorMessage message={passwordError} />
                </div>
                <div>
                    <FormInput
                        placeholder="Confirmar contraseña"
                        type="password"
                        setter={setPasswordConfirmation}
                        name="passwordConfirmation"
                    />
                    <ErrorMessage message={passwordConfirmationError} />
                </div>
            </div>
            <div className="flex flex-col mx-4 mt-20 space-y-2">
                <PrimaryButton
                    text="Registrarse aquí"
                    action={registerRequest}
                />
                <Link
                    href="/"
                    as="button"
                    type="button"
                    className="border border-white py-2 rounded-full"
                >
                    Iniciar Sesión
                </Link>
            </div>

            <Modal
                open={open}
                onClose={handleClose}
                aria-labelledby="modal-modal-title"
                aria-describedby="modal-modal-description"
            >
                <Box sx={style}>
                    <Typography
                        id="modal-modal-title"
                        variant="h6"
                        component="h2"
                    >
                        Registro correcto
                    </Typography>
                    <Typography id="modal-modal-description" sx={{ mt: 2 }}>
                        {message}
                    </Typography>
                </Box>
            </Modal>
        </div>
    );

    function registerRequest() {
        let hasErrors = determineErrors();
        if (hasErrors) {
            return;
        }

        fetch("/api/auth/register", {
            body: JSON.stringify({
                username: username,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
            }),
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            method: "POST",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    setMessage(data.message);
                    handleOpen();
                }
                if (data.errors) {
                    setUsernameError(data.errors.username);
                    setEmailError(data.errors.email);
                    setPasswordError(data.errors.password);
                    setPasswordConfirmationError(
                        data.errors.password_confirmation
                    );
                }
            })
            .catch((error) => console.error(error));
    }

    function determineErrors() {
        let hasErrors = false;

        if (username === "") {
            setUsernameError("El usuario es obligatorio");
            hasErrors = true;
        } else {
            setUsernameError("");
            hasErrors = false;
        }

        if (email === "") {
            setEmailError("El correo es obligatorio");
            hasErrors = true;
        } else {
            setEmailError("");
            hasErrors = false;
        }

        if (password === "") {
            setPasswordError("La contraseña es obligatoria");
            hasErrors = true;
        } else {
            setPasswordError("");
            hasErrors = false;
        }

        if (password_confirmation === "") {
            setPasswordConfirmationError(
                "La confirmación de contraseña es obligatoria"
            );
            hasErrors = true;
        } else {
            setPasswordConfirmationError("");
            hasErrors = false;
        }

        if (password !== password_confirmation) {
            setError(false);
            hasErrors = true;
        }

        return hasErrors;
    }
}
