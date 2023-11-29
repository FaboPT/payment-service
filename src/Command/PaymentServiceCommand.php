<?php

namespace App\Command;

use App\emuns\PaymentMethodType;
use App\Services\PaymentService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\JsonResponse;

#[AsCommand(
    name: 'payments',
    description: 'Command to execute payments service',
)]
class PaymentServiceCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'username',
            null,
            InputOption::VALUE_REQUIRED,
            'Type your username',
            false
        );
        $this->addOption(
            'email',
            null,
            InputOption::VALUE_REQUIRED,
            'Type your email',
            false
        );
        $this->addOption(
            'paymentMethod',
            null,
            InputOption::VALUE_REQUIRED,
            'Type your paymentMethod',
            false,
            function (CompletionInput $input): array {
                $currentValue = $input->getCompletionValue();

                    return PaymentMethodType::cases();
                }
        );
        $this->addOption(
            'amount',
            null,
            InputOption::VALUE_REQUIRED,
            'Type your amount',
            false
        );
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $options = $input->getOptions();

        $paymentService = new PaymentService(
            (float) $input->getOption('amount'),
            $input->getOption('username'),
            $input->getOption('email'),
            $input->getOption('paymentMethod'),
        );

        $output->writeln($paymentService->payment());

        return Command::SUCCESS;

    }
}
