import GuestLayout from "@/Layouts/GuestLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import { Head, Link, useForm } from "@inertiajs/react";

export default function VerifyEmail({ status }) {
    const { post, processing } = useForm({});

    const submit = (e) => {
        e.preventDefault();

        post(route("verification.send"));
    };

    return (
        <GuestLayout>
            <Head title="Verificação de E-mail" />

            <div className="mb-4 text-sm text-gray-600">
                Obrigado por se inscrever! Antes de começar, você poderia
                verificar seu endereço de e-mail clicando no link que acabamos
                de enviar para você? Se você não recebeu o e-mail, teremos
                prazer em enviar outro.
            </div>

            {status === "verification-link-sent" && (
                <div className="mb-4 font-medium text-sm text-green-600">
                    Uma nova link de verificação foi enviado para o endereço de
                    e-mail que você forneceu durante o registro.
                </div>
            )}

            <form onSubmit={submit}>
                <div className="mt-4 flex items-center justify-between">
                    <PrimaryButton disabled={processing}>
                        Reenviar E-mail de Verificação.
                    </PrimaryButton>

                    <Link
                        href={route("logout")}
                        method="post"
                        as="button"
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Sair
                    </Link>
                </div>
            </form>
        </GuestLayout>
    );
}
